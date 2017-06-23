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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zone_id', 'province_id', 'amphur_id', 'district_id', 'region_id', 'img_id', 'created_by', 'update_by'], 'integer'],
            [['zone_name', 'information', 'update_date', 'created_date'], 'safe'],
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
        $query = ResearchZone::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'zone_id' => $this->zone_id,
            'province_id' => $this->province_id,
            'amphur_id' => $this->amphur_id,
            'district_id' => $this->district_id,
            'region_id' => $this->region_id,
            'img_id' => $this->img_id,
            'update_date' => $this->update_date,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'zone_name', $this->zone_name])
            ->andFilterWhere(['like', 'information', $this->information]);

        return $dataProvider;
    }
}
