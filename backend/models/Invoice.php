<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id_invoice
 * @property string $date
 * @property string $no
 * @property integer $seller_id
 * @property integer $buyer_company1
 *
 * @property InvoiceCompany $seller
 * @property InvoiceCompany $buyerCompany1
 * @property InvoiceProductCount[] $invoiceProductCounts
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'no', 'seller_id', 'buyer_company1'], 'required'],
            [['date'], 'safe'],
            [['seller_id', 'buyer_company1'], 'integer'],
            [['no'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice' => Yii::t('app', 'Id Invoice'),
            'date' => Yii::t('app', 'Date'),
            'no' => Yii::t('app', 'No'),
            'seller_id' => Yii::t('app', 'Seller ID'),
            'buyer_company1' => Yii::t('app', 'Buyer Company1'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(InvoiceCompany::className(), ['id_invoice_company' => 'seller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyerCompany1()
    {
        return $this->hasOne(InvoiceCompany::className(), ['id_invoice_company' => 'buyer_company1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceProductCounts()
    {
        return $this->hasMany(InvoiceProductCount::className(), ['invoice_id' => 'id_invoice']);
    }
}
