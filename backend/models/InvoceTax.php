<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoce_tax".
 *
 * @property integer $id_invoce_tax
 * @property integer $percent
 * @property string $name
 *
 * @property InvoiceProduct[] $invoiceProducts
 */
class InvoceTax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoce_tax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['percent', 'name'], 'required'],
            [['percent'], 'integer'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoce_tax' => Yii::t('app', 'Id Invoce Tax'),
            'percent' => Yii::t('app', 'Percent'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::className(), ['tax_id' => 'id_invoce_tax']);
    }
}
