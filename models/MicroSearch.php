<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Micro;

/**
 * MicroSearch represents the model behind the search form about `app\models\Micro`.
 */
class MicroSearch extends Micro
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mic_id', 'zone_id', 'img_code', 'type_id', 'created_by', 'update_by'], 'integer'],
            [['genus', 'species', 'gen_info', 'banefit', 'update_date', 'created_date'], 'safe'],
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
        $query = Micro::find();

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
            'mic_id' => $this->mic_id,
            'zone_id' => $this->zone_id,
            'img_code' => $this->img_code,
            'type_id' => $this->type_id,
            'update_date' => $this->update_date,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'genus', $this->genus])
            ->andFilterWhere(['like', 'species', $this->species])
            ->andFilterWhere(['like', 'gen_info', $this->gen_info])
            ->andFilterWhere(['like', 'banefit', $this->banefit]);

        return $dataProvider;
    }
}
