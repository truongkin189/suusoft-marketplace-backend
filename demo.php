<?php
function haversineGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;

            $a = "->innerJoin('product_deal', 'app_user.id = product_deal.seller.id')
            ->innerJoin('object_category', 'product_deal.category_id = object_category.id')";
}

echo 'test '.haversineGreatCircleDistance(21.181810, 103.574948, 21.181310, 103.575060).'<br>';

// echo 'id88 '.haversineGreatCircleDistance(20.9815717, 105.7111576, 20.9816394, 105.7112425).'<br>';
// echo 'id82 '.haversineGreatCircleDistance(21.181310, 103.575060, 20.9816394, 105.7112425);