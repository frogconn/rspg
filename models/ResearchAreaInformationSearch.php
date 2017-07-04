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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'amphur_id', 'district_id', 'region_id', 'image_id', 'created_by', 'updated_by'], 'integer'],
            [['information', 'created_date', 'updated_date'], 'safe'],
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
        $query = ResearchAreaInformation::find();

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

        $query->andFilterWhere(['like', 'information', $this->information]);

        return $dataProvider;
    }
}
