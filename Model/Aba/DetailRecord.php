<?php
/**
 * Author: Latysh (Altynbek Usenov).
 */

namespace Latysh\AbaBundle\Model\Aba;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class DetailRecord implements TransactionInterface
{

    /** @var string */
    private $recordId;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\EqualTo(value = 1)
     */
    private $recordType;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern = "/^[\d]{3}-[\d]{3}$/",
     *     message = "Bsb is invalid. Required format is 000-000."
     * )
     */
    private $bsb;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern = "/^[\d]{0,9}$/",
     *     message = "Account number is invalid. Must be up to 9 digits only. Remove dashes and spaces."
     * )
     */
    private $accountNumber;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^N|T|W|X|Y| /",
     *     message = "Transaction indicator is invalid. Must be one of W, X, Y or null."
     * )
     */
    private $indicator;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getTransactionCodes")
     */
    private $transactionCode;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer",
     *     message="The amount {{ value }} is not a valid {{ type }}."
     * )
     * @Assert\LessThanOrEqual(value = 9999999999 )
     */
    private $amount;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern = "/^[\w\s\_?\^\[\],.+-;:=#\/\*\(\)&%!\$@]{0,32}$/",
     *     message = "Account name is invalid. Must be letters only and up to 32 characters long."
     * )
     */
    private $accountName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern = "/^[\w\s\_?\^\[\],.+-;:=#\/\*\(\)&%!\$@]{0,18}$/",
     *     message = "Reference is invalid. Must be letters only and up to 18 characters long."
     * )
     */
    private $reference;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\_?\^\[\],.+-;:=#\/\*\(\)&%!\$@]{0,16}$/",
     *     message = "Remitter is invalid. Must be letters only and up to 16 characters long."
     * )
     */
    private $remitter;

    /**
     * @var int
     *
     * @Assert\Type(
     *     type="integer",
     *      message = "Withholding amount is invalid. Must be digits only and up to 8 characters long.{{ type }}"
     * )
     * @Assert\LessThanOrEqual(value = 99999999 )
     */
    private $taxWithholding;

    public function __construct()
    {
        $this->setRecordType('1');
        $this->setIndicator(null);
        $this->setRemitter(null);
        $this->setTaxWithholding(0);
    }

    public static function getTransactionCodes()
    {
        return [
            TransactionCode::EXTERNALLY_INITIATED_DEBIT,
            TransactionCode::EXTERNALLY_INITIATED_CREDIT,
            TransactionCode::AUSTRALIAN_GOVERNMENT_SECURITY_INTEREST,
            TransactionCode::FAMILY_ALLOWANCE,
            TransactionCode::PAYROLL_PAYMENT,
            TransactionCode::PENSION_PAYMENT,
            TransactionCode::ALLOTMENT,
            TransactionCode::DIVIDEND,
            TransactionCode::DEBENTURE_OR_NOTE_INTEREST,
        ];
    }

    /**
     * @param ExecutionContextInterface $context
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        //additional validations
        if (in_array($this->getIndicator(), ['W', 'X', 'Y']) && $this->getTaxWithholding() == '') {
            $context->buildViolation('If indicator is either W, X, Y then you have to set withholding tax')
                ->atPath('indicator')
                ->addViolation();
        }
    }

    /**
     * Gets record id
     * @return string
     */
    public function getRecordId()
    {
        return $this->recordId;
    }

    /**
     * Sets record id
     * @param $recordId
     */
    public function setRecordId($recordId)
    {
        $this->recordId = $recordId;
    }

    /**
     * @return string
     */
    public function getRecordType()
    {
        return $this->recordType;
    }

    /**
     * @param string $recordType
     */
    public function setRecordType($recordType)
    {
        $this->recordType = $recordType;
    }

    /**
     * @return string
     */
    public function getBsb()
    {
        return $this->bsb;
    }

    /**
     * @param string $bsb
     */
    public function setBsb($bsb)
    {
        $this->bsb = $bsb;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return string
     */
    public function getIndicator()
    {
        return $this->indicator;
    }

    /**
     * @param string $indicator
     */
    public function setIndicator($indicator)
    {
        $this->indicator = $indicator;
    }

    /**
     * @return string
     */
    public function getTransactionCode()
    {
        return $this->transactionCode;
    }

    /**
     * @param string $transactionCode
     */
    public function setTransactionCode($transactionCode)
    {
        $this->transactionCode = $transactionCode;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @param string $accountName
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getRemitter()
    {
        return $this->remitter;
    }

    /**
     * @param string $remitter
     */
    public function setRemitter($remitter)
    {
        $this->remitter = $remitter;
    }

    /**
     * @return int
     */
    public function getTaxWithholding()
    {
        return $this->taxWithholding;
    }

    /**
     * @param int $taxWithholding
     */
    public function setTaxWithholding($taxWithholding)
    {
        $this->taxWithholding = $taxWithholding;
    }
}
