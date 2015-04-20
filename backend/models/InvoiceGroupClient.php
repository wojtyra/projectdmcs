<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice_group_client".
 *
 * @property integer $id_invoice_group_client
 *
 * @property InvoiceClient[] $invoiceClients
 * @property InvoiceCompany[] $invoiceCompanies
 * @property InvoiceProduct[] $invoiceProducts
 */
class InvoiceGroupClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_group_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice_group_client' => Yii::t('app', 'Id Invoice Group Client'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceClients()
    {
        return $this->hasMany(InvoiceClient::className(), ['invoice_group_client_id' => 'id_invoice_group_client']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceCompanies()
    {
        return $this->hasMany(InvoiceCompany::className(), ['invoice_group_client_id' => 'id_invoice_group_client']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::className(), ['invoice_group_client_id' => 'id_invoice_group_client']);
    }
}
