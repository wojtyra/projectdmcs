<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice_product".
 *
 * @property integer $id_invoice_product
 * @property string $title
 * @property string $price
 * @property integer $tax_id
 * @property integer $client_product_id
 * @property integer $invoice_group_client_id
 *
 * @property InvoceTax $tax
 * @property InvoiceGroupClient $invoiceGroupClient
 * @property InvoiceProductCount[] $invoiceProductCounts
 */
class InvoiceProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'price', 'tax_id', 'invoice_group_client_id'], 'required'],
            [['tax_id', 'client_product_id', 'invoice_group_client_id'], 'integer'],
            [['title', 'price'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice_product' => Yii::t('app', 'Id Invoice Product'),
            'title' => Yii::t('app', 'Title'),
            'price' => Yii::t('app', 'Price'),
            'tax_id' => Yii::t('app', 'Tax ID'),
            'client_product_id' => Yii::t('app', 'Client Product ID'),
            'invoice_group_client_id' => Yii::t('app', 'Invoice Group Client ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTax()
    {
        return $this->hasOne(InvoceTax::className(), ['id_invoce_tax' => 'tax_id']);
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
    public function getInvoiceProductCounts()
    {
        return $this->hasMany(InvoiceProductCount::className(), ['invoice_product_id' => 'id_invoice_product']);
    }
}
