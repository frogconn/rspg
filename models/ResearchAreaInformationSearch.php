<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ResearchAreaInformation;

/**
 * ResearchAreaInformationSearch represents the model behind the search form about `app\models\ResearchAreaInformation`.
 */
class ResearchAreaInformationSearch extends ResearchAreaInformation
{
    public $searchAll;
    public $province_name;
    public $amphur_name;
    public $district_name;
    public $region_name;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'amphur_id', 'district_id', 'region_id', 'image_id', 'created_by', 'updated_by'], 'integer'],
            [['information', 'created_date', 'updated_date','searchAll', 'province_name', 'amphur_name', 'district_name', 'region_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
         $query = ResearchAreaInformation::find()->joinWith('addressProvince')->joinWith('addressAmphur')->joinWith('addressDistrict')->joinWith('addressRegion');


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $dataProvider->sort->attributes['province_name'] = [
            'asc' => ['address_province.name' => SORT_ASC],
            'desc' => ['address_province.name'=> SORT_DESC], 
        ]; 

        $dataProvider->sort->attributes['amphur_name'] = [
            'asc' => ['address_amphur.name' => SORT_ASC],
            'desc' => ['address_amphur.name'=> SORT_DESC], 
        ];
        $dataProvider->sort->attributes['district_name'] = [
            'asc' => ['address_district.name' => SORT_ASC],
            'desc' => ['address_district.name'=> SORT_DESC], 
        ];
        $dataProvider->sort->attributes['region_name'] = [
            'asc' => ['address_region.name' => SORT_ASC],
            'desc' => ['address_region.name'=> SORT_DESC], 
        ];



        // grid filtering conditions
        /*$query->andFilterWhere([
            'id' => $this->id,
            'province_id' => $this->province_id,
            'amphur_id' => $this->amphur_id,
            'district_id' => $this->district_id,
            'region_id' => $this->region_id,
            'image_id' => $this->image_id,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);
*/
        $query
        -> orFilterWhere([ 'like', 'address_province.name', $this->searchAll ])
        -> orFilterWhere([ 'like', 'address_district.name', $this->searchAll ])
        -> orFilterWhere([ 'like', 'address_region.name', $this->searchAll ])
        ->orFilterWhere([ 'like', 'address_amphur.name', $this->searchAll ]);
       // ->orFilterWhere([ 'like', 'district_id', $this->searchAll ])
       // ->orFilterWhere([ 'like', 'region_id', $this->searchAll ]);
         return $dataProvider;
    }
}
