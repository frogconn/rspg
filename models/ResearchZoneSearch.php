<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ResearchZone;

/**
 * ResearchZoneSearch represents the model behind the search form about `app\models\ResearchZone`.
 */
class ResearchZoneSearch extends ResearchZone
{
    public $p_name; // add from province table
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone_id', 'p_id', 'a_id', 'd_id', 'geo_id', 'img_id', 'created_by', 'update_by'], 'integer'],
            [['gen_info', 'p_name', 'a_name', 'd_name', 'update_date', 'created_date', ], 'safe'], // add p_name
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
        $query = ResearchZone::find()->joinWith('province')->joinWith('amphur')->joinWith('district');

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

        $dataProvider->sort->attributes['p_name']=[
            'asc'=>['province.p_name'=>SORT_ASC],
            'desc'=>['province.p_name'=>SORT_DESC],
        ];

        $dataProvider->sort->attributes['a_name']=[
            'asc'=>['amphur.a_name'=>SORT_ASC],
            'desc'=>['amphur.a_name'=>SORT_DESC],
        ];

        $dataProvider->sort->attributes['d_name']=[
            'asc'=>['district.d_name'=>SORT_ASC],
            'desc'=>['district.d_name'=>SORT_DESC],
        ];

        // grid filtering conditions
        /*$query->andFilterWhere([
            //'zone_id' => $this->zone_id,
            //'p_id' => $this->p_id,
            //'a_id' => $this->a_id,
            //'d_id' => $this->d_id,
            //'geo_id' => $this->geo_id,
            //'img_id' => $this->img_id,
            //'update_date' => $this->update_date,
            //'created_by' => $this->created_by,
            //'created_date' => $this->created_date,
            //'update_by' => $this->update_by,
        ]);*/

        $query->andFilterWhere(['like', 'gen_info', $this->gen_info])
            ->andFilterWhere(['like', 'district.d_name', $this->d_name])
            ->andFilterWhere(['like', 'amphur.a_name', $this->a_name])
            ->andFilterWhere(['like', 'province.p_name', $this->p_name]);

        return $dataProvider;
    }
}
