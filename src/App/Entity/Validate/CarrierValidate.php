<?php


namespace App\Entity\Validate;

use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;


class CarrierValidate
{
    /**
     * @Assert\NotBlank(message = "zipcode is required")
     * @Assert\Type(
     *     type="string",
     *     message="zipcode - The value {{ value }} is not a valid {{ type }}."
     * )
     * @Type("string")
     */
    public $zipcode;

    /**
     * @Assert\NotBlank(message = "category is required")
     * @Assert\Type(
     *     type="int",
     *     message="category - The value {{ value }} is not a valid {{ type }}."
     * )
     * @Type("int")
     */
    public $category;

    /**
     * @Assert\NotBlank(message = "amount is required")
     * @Assert\Type(
     *     type="int",
     *     message="amount - The value {{ value }} is not a valid {{ type }}."
     * )
     * @Type("int")
     */
    public $amount;

    /**
     * @Assert\NotBlank(message = "unitary_weight is required")
     * @Assert\Type(
     *     type="int",
     *     message="unitary_weight - The value {{ value }} is not a valid {{ type }}."
     * )
     * @Type("int")
     */
    public $unitary_weight;

    /**
     * @Assert\NotBlank(message = "price is required")
     * @Assert\Type(
     *     type="int",
     *     message="price - The value {{ value }} is not a valid {{ type }}."
     * )
     * @Type("int")
     */
    public $price;

    /**
     * @Assert\NotBlank(message = "sku is required")
     * @Assert\Type(
     *     type="string",
     *     message="sku - The value {{ value }} is not a valid {{ type }}."
     * )
     * @Type("string")
     */
    public $sku;

    /**
     * @Assert\NotBlank(message = "height is required")
     * @Assert\Type(
     *     type="float",
     *     message="height - The value {{ value }} is not a valid {{ type }}."
     * )
     * @Type("float")
     */
    public $height;

    /**
     * @Assert\NotBlank(message = "width is required")
     * @Assert\Type(
     *     type="float",
     *     message="width - The value {{ value }} is not a valid {{ type }}."
     * )
     * @Type("float")
     */
    public $width;

    /**
     * @Assert\NotBlank(message = "length is required")
     * @Assert\Type(
     *     type="float",
     *     message="length - The value {{ value }} is not a valid {{ type }}."
     * )
     * @Type("float")
     */
    public $length;

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getUnitaryWeight()
    {
        return $this->unitary_weight;
    }

    /**
     * @param mixed $unitary_weight
     */
    public function setUnitaryWeight($unitary_weight): void
    {
        $this->unitary_weight = $unitary_weight;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length): void
    {
        $this->length = $length;
    }

}