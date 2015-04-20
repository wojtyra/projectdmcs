<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice_company".
 *
 * @property integer $id_invoice_company
 * @property integer $is_account_company
 * @property integer $invoice_group_client_id
 *
 * @property Invoice[] $invoices
 * @property InvoiceGroupClient $invoiceGroupClient
 * @property InvoiceCompanyData[] $invoiceCompanyDatas
 */
class InvoiceCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_account_company', 'invoice_group_client_id'], 'required'],
            [['is_account_company', 'invoice_group_client_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice_company' => Yii::t('app', 'Id Invoice Company'),
            'is_account_company' => Yii::t('app', 'Is Account Company'),
            'invoice_group_client_id' => Yii::t('app', 'Invoice Group Client ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['buyer_company1' => 'id_invoice_company']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceGroupClient()
    {
        return $this->hasOne(InvoiceGroupClient::className(), ['id_invoice_group_client' => 'invoice_group_client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceCompanyDatas()
    {
        return $this->hasMany(InvoiceCompanyData::className(), ['invoice_company_id' => 'id_invoice_company']);
    }
}
