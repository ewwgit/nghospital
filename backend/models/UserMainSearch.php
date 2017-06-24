<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserMain;

/**
 * UserMainSearch represents the model behind the search form about `backend\models\UserMain`.
 */
class UserMainSearch extends UserMain
{
    /**
     * @inheritdoc
     */
	public $city;
	public $stateCode;
	public $countryName;
    public function rules()
    {
        return [
            [['id','created_at', 'updated_at', 'role'], 'integer'],
        		
		        		[
				        		'username',
				        		'match',
				        		'pattern' => '/^[a-zA-Z0-9\s]+$/',
				        		'message' => 'username  can only contain characters.'
		        		],
        				/* [
        						'email',
        						'match',
        						'pattern' => '/^[a-zA-Z0-9\s]+$/',
        						'message' => 'email can only contain characters.'
        				], */
        				[
        						'status',
        						'match',
        						'pattern' => '/^[a-zA-Z0-9\s]+$/',
        						'message' => 'status can only contain characters.'
        				],
        		
            [['username', 'status', 'password_hash', 'password_reset_token', 'email', 'auth_key', 'password'], 'safe'],
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
    	if(isset($params['role']))
    	{
    		$query = UserMain::find()->where(['role' => $params['role']])->where(['not in','role',['1','2','3']]);
    	}
    	else 
    	{
        $query = UserMain::find()->where(['not in','role',['1','2','3','0']]);
    	}

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        		'sort' => ['attributes' => ['username','email','status','city','stateCode','countryName','role']],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        
        $query->joinWith('register');
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'role' => $this->role,
            
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
           ;
        
            //print_r($dataProvider->getModels());exit();

        return $dataProvider;
    }
}
