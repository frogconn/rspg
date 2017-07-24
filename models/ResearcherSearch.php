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
   public $searchAll;

    /**


     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['searchAll','personal_code', 'is_foreigner', 'title', 'firstname_th', 'lastname_th', 'firstname_en', 'lastname_en', 'fullname_th', 'fullname_en', 'gender', 'email', 'telephone', 'evidence_file', 'created_date', 'updated_date'], 'safe'],
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
            $query = Researcher::find();
        } else {
            $query = Researcher::find()->where(['created_by'=>$session['user_id']]);
        }
        
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
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);

        $query->orFilterWhere(['like', 'personal_code', $this->searchAll])
         ->orFilterWhere(['like', 'fullname_th', $this->searchAll])
        ->orFilterWhere(['like', 'fullname_en', $this->searchAll]);

        $query->andFilterWhere(['like', 'is_foreigner', $this->is_foreigner])
        ->andFilterWhere(['like', 'gender', $this->gender]);
        
        return $dataProvider;
    }
}
