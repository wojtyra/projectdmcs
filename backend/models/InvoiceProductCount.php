<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice_product_count".
 *
 * @property integer $id_invoice_product_count
 * @property integer $invoice_product_id
 * @property integer $invoice_id
 * @property integer $count
 *
 * @property InvoiceProduct $invoiceProduct
 * @property Invoice $invoice
 */
class InvoiceProductCount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_product_count';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_product_id', 'invoice_id', 'count'], 'required'],
            [['invoice_product_id', 'invoice_id', 'count'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice_product_count' => Yii::t('app', 'Id Invoice Product Count'),
            'invoice_product_id' => Yii::t('app', 'Invoice Product ID'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'count' => Yii::t('app', 'Count'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceProduct()
    {
        return $this->hasOne(InvoiceProduct::className(), ['id_invoice_product' => 'invoice_product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id_invoice' => 'invoice_id']);
    }
}
