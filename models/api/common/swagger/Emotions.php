<?php

namespace app\models\ajax;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"angry", "happy", "neutral", "sad", "surprise"})
 *
 * @SWG\Property(
 *     property="angry",
 *     type="number",
 *     format="float",
 *     description="Процент злости."
 * )
 * @SWG\Property(
 *     property="happy",
 *     type="number",
 *     format="float",
 *     description="Процент радости."
 * )
 * @SWG\Property(
 *     property="neutral",
 *     type="number",
 *     format="float",
 *     description="Процент безразличия."
 * )
 * @SWG\Property(
 *     property="sad",
 *     type="number",
 *     format="float",
 *     description="Процент грусти."
 * )
 * @SWG\Property(
 *     property="surprise",
 *     type="number",
 *     format="float",
 *     description="Процент удивлённости."
 * )
 */
class Emotions extends Model
{
    public float $angry;
    public float $happy;
    public float $neutral;
    public float $sad;
    public float $surprise;
}