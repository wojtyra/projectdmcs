<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice_client".
 *
 * @property integer $id_invoice_client
 * @property integer $invoice_group_client_id
 * @property string $username
 * @property string $password_hash
 *
 * @property InvoiceGroupClient $invoiceGroupClient
 */
class InvoiceClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_group_client_id'], 'required'],
            [['invoice_group_client_id'], 'integer'],
            [['username', 'password_hash'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice_client' => Yii::t('app', 'Id Invoice Client'),
            'invoice_group_client_id' => Yii::t('app', 'Invoice Group Client ID'),
            'username' => Yii::t('app', 'Username'),
            'password_hash' => Yii::t('app', 'Password Hash'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceGroupClient()
    {
        return $this->hasOne(InvoiceGroupClient::className(), ['id_invoice_group_client' => 'invoice_group_client_id']);
    }
}
