<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Plant;

/**
 * PlantSearch represents the model behind the search form about `app\models\Plant`.
 */
class PlantSearch extends Plant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'plant_id', 'zone_id', 'img_code', 'type_id', 'created_by', 'update_by'], 'integer'],
            [['com_name', 'loc_name', 'sc_name', 'fam_name', 'gen_info', 'banefit', 'update_date', 'created_date'], 'safe'],
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
        $query = Plant::find();

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
            'plant_id' => $this->plant_id,
            'zone_id' => $this->zone_id,
            'img_code' => $this->img_code,
            'type_id' => $this->type_id,
            'update_date' => $this->update_date,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'com_name', $this->com_name])
            ->andFilterWhere(['like', 'loc_name', $this->loc_name])
            ->andFilterWhere(['like', 'sc_name', $this->sc_name])
            ->andFilterWhere(['like', 'fam_name', $this->fam_name])
            ->andFilterWhere(['like', 'gen_info', $this->gen_info])
            ->andFilterWhere(['like', 'banefit', $this->banefit]);

        return $dataProvider;
    }
}
