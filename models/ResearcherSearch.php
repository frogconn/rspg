<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Researcher;

/**
 * ResearcherSearch represents the model behind the search form about `app\models\Researcher`.
 */
class ResearcherSearch extends Researcher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'update_by'], 'integer'],
            [['foreigner', 'gender', 'pers_id', 'title', 'firstname_th', 'lastname_th', 'firstname_en', 'lastname_en', 'fullname_th', 'fullname_en', 'email', 'telephone', 'update_date', 'created_date'], 'safe'],
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
        $query = Researcher::find();

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

        $dataProvider->sort->attributes['fullname']=[
            'asc'=>['name'=>SORT_ASC,'surname'=>SORT_DESC],
            'desc'=>['name'=>SORT_DESC,'surname'=>SORT_DESC],
        ];

        $query//->andFilterWhere(['like', 'foreigner', $this->foreigner])
            //->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'pers_id', $this->pers_id])
            //->andFilterWhere(['like', 'title', $this->title])
            //->andFilterWhere(['like', 'firstname_th', $this->firstname_th])
            //->andFilterWhere(['like', 'lastname_th', $this->lastname_th])
            //->andFilterWhere(['like', 'firstname_en', $this->firstname_en])
            //->andFilterWhere(['like', 'lastname_en', $this->lastname_en])
            ->andFilterWhere(['like', 'fullname_th', $this->fullname_th])
            ->andFilterWhere(['like', 'fullname_en', $this->fullname_en])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telephone', $this->telephone]);

        return $dataProvider;
    }

}
