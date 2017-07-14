<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ResourceAnimal;

/**
 * ResourceAnimalSearch represents the model behind the search form about `app\models\ResourceAnimal`.
 */
class ResourceAnimalSearch extends ResourceAnimal
{
    public $searchAll;
    public $zone_name;
    public $type_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zone_id', 'image_id', 'type_id', 'created_by', 'updated_by'], 'integer'],
            [['zone_name', 'common_name', 'location_name', 'science_name', 'family_name', 'information', 'benefit', 'created_date', 'updated_date', 'type_name', 'searchAll'], 'safe'],
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
        $query = ResourceAnimal::find()->joinWith('researchArea')->joinWith('resourceType');

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

        $dataProvider->sort->attributes['zone_name'] = [
            'asc' => ['research_area.name' => SORT_ASC],
            'desc' => ['research_area.name'=> SORT_DESC], 
        ]; 

        $dataProvider->sort->attributes['type_name']=[
            'asc'=>['resource_type.name'=>SORT_ASC],
            'desc'=>['resource_type.name'=>SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'zone_id' => $this->zone_id,
            'image_id' => $this->image_id,
            'type_id' => $this->type_id,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'common_name', $this->common_name])
            ->andFilterWhere(['like', 'location_name', $this->location_name])
            ->andFilterWhere(['like', 'science_name', $this->science_name])
            ->andFilterWhere(['like', 'family_name', $this->family_name])
            //->andFilterWhere(['like', 'information', $this->information])
            ->andFilterWhere(['like', 'research_area.name', $this->zone_name])
            //->andFilterWhere(['like', 'benefit', $this->benefit])
            ->andFilterWhere(['like', 'resource_type.name', $this->type_name]);

        return $dataProvider;
    }
}
