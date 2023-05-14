<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Rate;
use App\Models\Currency;

class RateController extends Controller
{
    public function search(Request $request) {
        if(!$request->currency) {
            return response()->json(["error" => "Parameter 'currency' is empty!"])->setStatusCode(400);
        }

        if(!$request->date_start && !$request->date_end) {
            return response()->json(["error" => "Parameters 'date_start' and 'date_end' is empty!"])->setStatusCode(400);
        }

        // Подготовка запросов
        $query_currency = Rate::select(['date', 'rate']);
        $query_currency_convert = Rate::select(['date', 'rate']);

        // Получаем код валюты, которую нажо конвертировать
        $currency = Currency::where('code', '=', mb_strtoupper(trim($request->currency)))->first();

        // Если не нашли то ошибка
        if(!$currency) {
            return response()->json(["error" => "Currency not found!"])->setStatusCode(400);
        }

        $query_currency->where('currency_id', '=', $currency->id);

        // Получаем сведения о валюте относительно которой будем конверитровать курс (если не передано значит относительно рубля)
        $currency_convert = null;
        if($request->currency_convert) {
            $currency_convert = Currency::where('code', '=', mb_strtoupper(trim($request->currency_convert)))->first();

            if(!$currency_convert) {
                return response()->json(["error" => "Currency convertor not found!"])->setStatusCode(400);
            }

            $query_currency_convert->where('currency_id', '=', $currency_convert->id);
        }

        // Работаем с датами
        $date_start = $request->date_start ? Carbon::parse($request->date_start) : null;
        $date_end = $request->date_end ? Carbon::parse($request->date_end) : null;

        if($date_start && $date_end) {
            $query_currency->whereBetween('date', [$date_start, $date_end]);
            $query_currency_convert->whereBetween('date', [$date_start, $date_end]);
        } else if($date_start) {
            $query_currency->whereDate('date', $date_start);
            $query_currency_convert->whereDate('date', $date_start);
        } else if($date_end) {
            $query_currency_convert->whereDate('date', $date_end);
        }

        // Получаем курс валюты
        $rates = $query_currency->orderBy('date')->get()->toArray();

        // Получаем курс валюты относительно которой будем конвертировать
        $rates_convert = [];
        if($currency_convert) {
            $rates_convert = $query_currency_convert->orderBy('date')->get()->toArray();

            if(count($rates_convert) != count($rates)) {
                return response()->json(["error" => "Not enough data!"])->setStatusCode(400);
            }
        }

        $answer_rates = [];

        // Формируем итоговый массив с курсом
        foreach($rates as $index => $rate) {
            $rate_result = $rates_convert ? (float)$rate['rate'] / (float)$rates_convert[$index]['rate'] : (float)$rate['rate'];

            array_push($answer_rates, [
                "date" => $rate['date'],
                "rate" => round($rate_result, 4),
            ]);
        }

        // Формируем ответ
        $answer = [
            "currency" => $currency->code,
            "currency_name" => $currency->name,
            "currency_convert" => $currency_convert ? $currency_convert->code : 'RUB',
            "currency_convert_name" => $currency_convert ? $currency_convert->name : 'Российский рубль',
            "rates" => $answer_rates,
        ];

        return response()->json($answer);
    }
}
