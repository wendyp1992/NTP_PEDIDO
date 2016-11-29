<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property integer $idPersona
 * @property integer $idD
 * @property integer $idP
 * @property string $nombreP
 * @property integer $saldo
 * @property string $password
 * @property string $authkey
 *
 * @property Departamento $idD0
 * @property Producto $idPersona0
 */
class Persona extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idD', 'idP', 'nombreP', 'password', 'authkey'], 'required'],
            [['idD', 'idP', 'saldo'], 'integer'],
            [['nombreP', 'authkey'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 30],
            [['idD'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['idD' => 'idD']],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idPersona' => 'idP']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPersona' => 'Id Persona',
            'idD' => 'Id D',
            'idP' => 'Id P',
            'nombreP' => 'Nombre P',
            'saldo' => 'Saldo',
            'password' => 'Password',
            'authkey' => 'Authkey',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdD0()
    {
        return $this->hasOne(Departamento::className(), ['idD' => 'idD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersona0()
    {
        return $this->hasOne(Producto::className(), ['idP' => 'idPersona']);
    }
    
      public function getAuthKey() {
        throw new \yii\base\NotSupportedException();
    }

    public function validateAuthKey($authKey) {
        throw new \yii\base\NotSupportedException();
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException();
    }

    public static function findByUsername($username) {
        return self::findOne(['nombreP' => $username]);
    }

    public function validatePassword($password) {
        return $this->password == $password;
    }

    public function getId() {
        return $this->idD;
    }
}
