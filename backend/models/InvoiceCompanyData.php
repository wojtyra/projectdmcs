<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice_company_data".
 *
 * @property integer $id_invoice_company_data
 * @property integer $invoice_company_id
 * @property string $name
 * @property string $nip
 * @property string $postcode
 * @property string $city
 * @property string $street
 * @property string $date_from
 *
 * @property InvoiceCompany $invoiceCompany
 */
class InvoiceCompanyData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_company_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_company_id', 'name', 'nip', 'postcode', 'city', 'street', 'date_from'], 'required'],
            [['invoice_company_id'], 'integer'],
            [['date_from'], 'safe'],
            [['name', 'postcode', 'city', 'street'], 'string', 'max' => 45],
            [['nip'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice_company_data' => Yii::t('app', 'Id Invoice Company Data'),
            'invoice_company_id' => Yii::t('app', 'Invoice Company ID'),
            'name' => Yii::t('app', 'Name'),
            'nip' => Yii::t('app', 'Nip'),
            'postcode' => Yii::t('app', 'Postcode'),
            'city' => Yii::t('app', 'City'),
            'street' => Yii::t('app', 'Street'),
            'date_from' => Yii::t('app', 'Date From'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceCompany()
    {
        return $this->hasOne(InvoiceCompany::className(), ['id_invoice_company' => 'invoice_company_id']);
    }
}
