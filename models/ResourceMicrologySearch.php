<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ResourceMicrology;

/**
 * ResourceMicrologySearch represents the model behind the search form about `app\models\ResourceMicrology`.
 */
class ResourceMicrologySearch extends ResourceMicrology
{
    /**
     * @inheritdoc
     */
    public $zone_name;
    public $type_name;
    public $searchAll;

    public function rules()
    {
        return [
            [['id', 'zone_id', 'image_id', 'type_id', 'created_by', 'updated_by'], 'integer'],
            [['genus','species','information', 'benefit', 'created_date', 'updated_date','searchAll'], 'safe'],
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
        $session = Yii::$app->session;
            
        // Is user admin or staff ?
        if ($session['user_role'] != 'Researcher') {
            $query = ResourceMicrology::find();
        } else {
            $query = ResourceMicrology::find()->where(['resource_micrology.created_by'=>$session['user_id']]);
        }
        $query->joinWith('researchArea')->joinWith('resourceType');

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

        $dataProvider->sort->attributes['zone_name']=[
            'asc'=>['research_area.name'=>SORT_ASC],
            'desc'=>['research_area.name'=>SORT_DESC],
        ];

        $dataProvider->sort->attributes['type_name']=[
            'asc'=>['resource_type.name'=>SORT_ASC],
            'desc'=>['resource_type.name'=>SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'zone_id' => $this->zone_id,
            'image_id' => $this->image_id,
            'type_id' => $this->type_id,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);

        $query
            ->andFilterWhere(['like', 'genus', $this->genus])
            ->andFilterWhere(['like', 'species', $this->species])
            ->orFilterWhere(['like', 'genus', $this->searchAll])
            ->andFilterWhere(['like', 'research_area.name', $this->zone_name])
            ->orFilterWhere(['like', 'species', $this->searchAll])
            ->andFilterWhere(['like', 'resource_type.name', $this->type_name]);


        return $dataProvider;
    }
}
