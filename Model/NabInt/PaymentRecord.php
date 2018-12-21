<?php

/**
 * Author: Latysh (Altynbek Usenov).
 */

namespace Latysh\AbaBundle\Model\NabInt;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class PaymentRecord
{
    /** @var string */
    private $recordId;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\EqualTo(value = 03)
     */
    private $indicator;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Currency()
     */
    private $payCurrencyCode;

    /**
     * @var float
     *
     * @Assert\Type(
     *     type="numeric",
     *     message="Payment amount value is not a valid {{ type }}."
     * )
     * @Assert\Range(
     *      min = 0.01,
     *      max = 999999999999999,
     *      minMessage = "Payment amount is invalid. Must be at least {{ limit }}",
     *      maxMessage = "Payment amount is invalid. Cannot be more than {{ limit }}"
     * )
     */
    private $paymentAmount;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $valueDate;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,16}$/",
     *     message = "Reference is invalid. Must be up to 16 characters, including special characters(+-/'?.,())."
     * )
     */
    private $reference;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Beneficiary name is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $beneficiaryName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Beneficiary address 1 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $beneficiaryAddress1;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Beneficiary address 2 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $beneficiaryAddress2;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^(.*?[A-Z]){2,}/",
     *     message = "Beneficiary address 3 is invalid. Must be up to 35 characters, including special characters(+-/'?.,()) and contain 2 letter country ISO code."
     * )
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Beneficiary address 3 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $beneficiaryAddress3;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern = "/^[\w\- ]{0,34}$/",
     *     message = "Beneficiary account number is invalid. Must be up to 34 characters consisting of letters, numbers, dashes (-) and spaces."
     * )
     */
    private $beneficiaryAccountNumber;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Beneficiary bank name is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $beneficiaryBankName;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,85}$/",
     *     message = "Beneficiary bank address 1 is invalid. Must be up to 85 characters, including special characters(+-/'?.,())."
     * )
     */
    private $beneficiaryBankAddress1;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Beneficiary bank address 2 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $beneficiaryBankAddress2;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^(.*?[A-Z]){2,}",
     *     message = "Beneficiary bank address 3 is invalid. Must be up to 35 characters, including special characters(+-/'?.,()) and contain 2 letter country ISO code."
     * )
     *
     * @Assert\Length(
     *      min = 0,
     *      max = 35,
     *      minMessage = "Payment record beneficiary bank address 3 must be at least {{ limit }} characters long",
     *      maxMessage = "Payment record beneficiary bank address 3 cannot be longer than {{ limit }} characters"
     * )
     */
    private $beneficiaryBankAddress3;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,3}$/",
     *     message = "Purpose of remittance is invalid. Must be up to 3 characters, including special characters(+-/'?.,())."
     * )
     */
    private $purposeOfRemittance;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^(B|R)$/",
     *     message = "Overseas bank charges is invalid. Must be one of B, R."
     * )
     */
    private $overseasBankCharges;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s]{0,35}$/",
     *     message = "Remitter name is invalid. Must be up to 35 letters and numbers."
     * )
     */
    private $remitterName;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\d]{3}$/",
     *     message = "Refinance days is invalid. Must be up to 3 digits."
     * )
     * @Assert\Range(
     *      min = 007,
     *      max = 365,
     *      minMessage = "Payment record refinance days is invalid. Must be at least {{ limit }}",
     *      maxMessage = "Payment record refinance days is invalid. Cannot be more than {{ limit }}"
     * )
     */
    private $refinanceDays;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     */
    private $refinanceDate;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?\/.,+-]{0,35}$/",
     *     message = "Additional beneficiary instructions 1 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $additionalBeneficiaryInstructions1;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Additional beneficiary instructions 2 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $additionalBeneficiaryInstructions2;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Additional beneficiary instructions 3 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $additionalBeneficiaryInstructions3;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Additional beneficiary instructions 4 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $additionalBeneficiaryInstructions4;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Additional instructions to NAB is invalid. Must be up to 275 characters, including special characters(+-/'?.,())."
     * )
     */
    private $additionalInstructionsToNab;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[A-Z]{0,2}$/",
     *     message = "Beneficiary bank country code is invalid. Must be up to 2 upper case letters"
     * )
     */
    private $beneficiaryBankCountryCode;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,11}$/",
     *     message = "Beneficiary BIC address is invalid. Must be up to 11 characters, including special characters(+-/'?.,())."
     * )
     */
    private $beneficiaryBicAddress;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^(FW|SC|CH)$/",
     *     message = "Routing type is invalid. Must be one of FW, SC, CH."
     * )
     */
    private $routingType;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w]{0,2}$/",
     *     message = "Overseas bank charges is invalid. Must be one up to 2 alphanumeric characters."
     * )
     */
    private $routingCode;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Originating applicant details 1 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $originatingApplicantDetails1;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Originating applicant details 2 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $originatingApplicantDetails2;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Originating applicant details 3 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $originatingApplicantDetails3;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern = "/^[\w\s\(\)\_?.,+-]{0,35}$/",
     *     message = "Originating applicant details 4 is invalid. Must be up to 35 characters, including special characters(+-/'?.,())."
     * )
     */
    private $originatingApplicantDetails4;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern = "/^[\d]{0,3}$/",
     *     message = "Number of detail record is invalid. Must be up to 3 digits"
     * )
     */
    private $numberOfDetailRecords;

    /**
     * @var array|PaymentDetailRecord
     * @Assert\NotBlank()
     */
    private $paymentDetailRecords;

    public function __construct()
    {
        $this->setIndicator('03');
    }

    /**
     * @param ExecutionContextInterface $context
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        //Routing type
        if ($this->getRoutingType() == '' && $this->getRoutingCode() != '') {
            $context->buildViolation(
                'Please check payment record routing type. It should be set, because you set routing code'
            )
                ->atPath('routingType')
                ->addViolation();
        }
        //Routing code
        if ($this->getRoutingCode() == '' && $this->getRoutingType() != '') {
            $context->buildViolation(
                'Please check payment record routing code. It should be set, because you set routing type'
            )
                ->atPath('routingType')
                ->addViolation();
        }
    }

    /**
     * Gets the record id
     * @return string
     */
    public function getRecordId()
    {
        return $this->recordId;
    }

    /**
     * Sets the record id
     * @param $recordId
     */
    public function setRecordId($recordId)
    {
        $this->recordId = $recordId;
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
    public function getPayCurrencyCode()
    {
        return $this->payCurrencyCode;
    }

    /**
     * @param string $payCurrencyCode
     */
    public function setPayCurrencyCode($payCurrencyCode)
    {
        $this->payCurrencyCode = $payCurrencyCode;
    }

    /**
     * @return float
     */
    public function getPaymentAmount()
    {
        return $this->paymentAmount;
    }

    /**
     * @param float $paymentAmount
     */
    public function setPaymentAmount($paymentAmount)
    {
        $this->paymentAmount = $paymentAmount;
    }

    /**
     * @return \DateTime
     */
    public function getValueDate()
    {
        return $this->valueDate;
    }

    /**
     * @param \DateTime $valueDate
     */
    public function setValueDate($valueDate)
    {
        $this->valueDate = $valueDate;
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
    public function getBeneficiaryName()
    {
        return $this->beneficiaryName;
    }

    /**
     * @param string $beneficiaryName
     */
    public function setBeneficiaryName($beneficiaryName)
    {
        $this->beneficiaryName = $beneficiaryName;
    }

    /**
     * @return string
     */
    public function getBeneficiaryAddress1()
    {
        return $this->beneficiaryAddress1;
    }

    /**
     * @param string $beneficiaryAddress1
     */
    public function setBeneficiaryAddress1($beneficiaryAddress1)
    {
        $this->beneficiaryAddress1 = $beneficiaryAddress1;
    }

    /**
     * @return string
     */
    public function getBeneficiaryAddress2()
    {
        return $this->beneficiaryAddress2;
    }

    /**
     * @param string $beneficiaryAddress2
     */
    public function setBeneficiaryAddress2($beneficiaryAddress2)
    {
        $this->beneficiaryAddress2 = $beneficiaryAddress2;
    }

    /**
     * @return string
     */
    public function getBeneficiaryAddress3()
    {
        return $this->beneficiaryAddress3;
    }

    /**
     * @param string $beneficiaryAddress3
     */
    public function setBeneficiaryAddress3($beneficiaryAddress3)
    {
        $this->beneficiaryAddress3 = $beneficiaryAddress3;
    }

    /**
     * @return string
     */
    public function getBeneficiaryAccountNumber()
    {
        return $this->beneficiaryAccountNumber;
    }

    /**
     * @param string $beneficiaryAccountNumber
     */
    public function setBeneficiaryAccountNumber($beneficiaryAccountNumber)
    {
        $this->beneficiaryAccountNumber = $beneficiaryAccountNumber;
    }

    /**
     * @return string
     */
    public function getBeneficiaryBankName()
    {
        return $this->beneficiaryBankName;
    }

    /**
     * @param string $beneficiaryBankName
     */
    public function setBeneficiaryBankName($beneficiaryBankName)
    {
        $this->beneficiaryBankName = $beneficiaryBankName;
    }

    /**
     * @return string
     */
    public function getBeneficiaryBankAddress1()
    {
        return $this->beneficiaryBankAddress1;
    }

    /**
     * @param string $beneficiaryBankAddress1
     */
    public function setBeneficiaryBankAddress1($beneficiaryBankAddress1)
    {
        $this->beneficiaryBankAddress1 = $beneficiaryBankAddress1;
    }

    /**
     * @return string
     */
    public function getBeneficiaryBankAddress2()
    {
        return $this->beneficiaryBankAddress2;
    }

    /**
     * @param string $beneficiaryBankAddress2
     */
    public function setBeneficiaryBankAddress2($beneficiaryBankAddress2)
    {
        $this->beneficiaryBankAddress2 = $beneficiaryBankAddress2;
    }

    /**
     * @return string
     */
    public function getBeneficiaryBankAddress3()
    {
        return $this->beneficiaryBankAddress3;
    }

    /**
     * @param string $beneficiaryBankAddress3
     */
    public function setBeneficiaryBankAddress3($beneficiaryBankAddress3)
    {
        $this->beneficiaryBankAddress3 = $beneficiaryBankAddress3;
    }

    /**
     * @return string
     */
    public function getPurposeOfRemittance()
    {
        return $this->purposeOfRemittance;
    }

    /**
     * @param string $purposeOfRemittance
     */
    public function setPurposeOfRemittance($purposeOfRemittance)
    {
        $this->purposeOfRemittance = $purposeOfRemittance;
    }

    /**
     * @return string
     */
    public function getOverseasBankCharges()
    {
        return $this->overseasBankCharges;
    }

    /**
     * @param string $overseasBankCharges
     */
    public function setOverseasBankCharges($overseasBankCharges)
    {
        $this->overseasBankCharges = $overseasBankCharges;
    }

    /**
     * @return string
     */
    public function getRemitterName()
    {
        return $this->remitterName;
    }

    /**
     * @param string $remitterName
     */
    public function setRemitterName($remitterName)
    {
        $this->remitterName = $remitterName;
    }

    /**
     * @return string
     */
    public function getRefinanceDays()
    {
        return $this->refinanceDays;
    }

    /**
     * @param string $refinanceDays
     */
    public function setRefinanceDays($refinanceDays)
    {
        $this->refinanceDays = $refinanceDays;
    }

    /**
     * @return \DateTime
     */
    public function getRefinanceDate()
    {
        return $this->refinanceDate;
    }

    /**
     * @param \DateTime $refinanceDate
     */
    public function setRefinanceDate($refinanceDate)
    {
        $this->refinanceDate = $refinanceDate;
    }

    /**
     * @return string
     */
    public function getAdditionalBeneficiaryInstructions1()
    {
        return $this->additionalBeneficiaryInstructions1;
    }

    /**
     * @param string $additionalBeneficiaryInstructions1
     */
    public function setAdditionalBeneficiaryInstructions1($additionalBeneficiaryInstructions1)
    {
        $this->additionalBeneficiaryInstructions1 = $additionalBeneficiaryInstructions1;
    }

    /**
     * @return string
     */
    public function getAdditionalBeneficiaryInstructions2()
    {
        return $this->additionalBeneficiaryInstructions2;
    }

    /**
     * @param string $additionalBeneficiaryInstructions2
     */
    public function setAdditionalBeneficiaryInstructions2($additionalBeneficiaryInstructions2)
    {
        $this->additionalBeneficiaryInstructions2 = $additionalBeneficiaryInstructions2;
    }

    /**
     * @return string
     */
    public function getAdditionalBeneficiaryInstructions3()
    {
        return $this->additionalBeneficiaryInstructions3;
    }

    /**
     * @param string $additionalBeneficiaryInstructions3
     */
    public function setAdditionalBeneficiaryInstructions3($additionalBeneficiaryInstructions3)
    {
        $this->additionalBeneficiaryInstructions3 = $additionalBeneficiaryInstructions3;
    }

    /**
     * @return string
     */
    public function getAdditionalBeneficiaryInstructions4()
    {
        return $this->additionalBeneficiaryInstructions4;
    }

    /**
     * @param string $additionalBeneficiaryInstructions4
     */
    public function setAdditionalBeneficiaryInstructions4($additionalBeneficiaryInstructions4)
    {
        $this->additionalBeneficiaryInstructions4 = $additionalBeneficiaryInstructions4;
    }

    /**
     * @return string
     */
    public function getAdditionalInstructionsToNab()
    {
        return $this->additionalInstructionsToNab;
    }

    /**
     * @param string $additionalInstructionsToNab
     */
    public function setAdditionalInstructionsToNab($additionalInstructionsToNab)
    {
        $this->additionalInstructionsToNab = $additionalInstructionsToNab;
    }

    /**
     * @return string
     */
    public function getBeneficiaryBankCountryCode()
    {
        return $this->beneficiaryBankCountryCode;
    }

    /**
     * @param string $beneficiaryBankCountryCode
     */
    public function setBeneficiaryBankCountryCode($beneficiaryBankCountryCode)
    {
        $this->beneficiaryBankCountryCode = $beneficiaryBankCountryCode;
    }

    /**
     * @return string
     */
    public function getBeneficiaryBicAddress()
    {
        return $this->beneficiaryBicAddress;
    }

    /**
     * @param string $beneficiaryBicAddress
     */
    public function setBeneficiaryBicAddress($beneficiaryBicAddress)
    {
        $this->beneficiaryBicAddress = $beneficiaryBicAddress;
    }

    /**
     * @return string
     */
    public function getRoutingType()
    {
        return $this->routingType;
    }

    /**
     * @param string $routingType
     */
    public function setRoutingType($routingType)
    {
        $this->routingType = $routingType;
    }

    /**
     * @return string
     */
    public function getRoutingCode()
    {
        return $this->routingCode;
    }

    /**
     * @param string $routingCode
     */
    public function setRoutingCode($routingCode)
    {
        $this->routingCode = $routingCode;
    }

    /**
     * @return string
     */
    public function getOriginatingApplicantDetails1()
    {
        return $this->originatingApplicantDetails1;
    }

    /**
     * @param string $originatingApplicantDetails1
     */
    public function setOriginatingApplicantDetails1($originatingApplicantDetails1)
    {
        $this->originatingApplicantDetails1 = $originatingApplicantDetails1;
    }

    /**
     * @return string
     */
    public function getOriginatingApplicantDetails2()
    {
        return $this->originatingApplicantDetails2;
    }

    /**
     * @param string $originatingApplicantDetails2
     */
    public function setOriginatingApplicantDetails2($originatingApplicantDetails2)
    {
        $this->originatingApplicantDetails2 = $originatingApplicantDetails2;
    }

    /**
     * @return string
     */
    public function getOriginatingApplicantDetails3()
    {
        return $this->originatingApplicantDetails3;
    }

    /**
     * @param string $originatingApplicantDetails3
     */
    public function setOriginatingApplicantDetails3($originatingApplicantDetails3)
    {
        $this->originatingApplicantDetails3 = $originatingApplicantDetails3;
    }

    /**
     * @return string
     */
    public function getOriginatingApplicantDetails4()
    {
        return $this->originatingApplicantDetails4;
    }

    /**
     * @param string $originatingApplicantDetails4
     */
    public function setOriginatingApplicantDetails4($originatingApplicantDetails4)
    {
        $this->originatingApplicantDetails4 = $originatingApplicantDetails4;
    }

    /**
     * @return string
     */
    public function getNumberOfDetailRecords()
    {
        return $this->numberOfDetailRecords;
    }

    /**
     * @param string $numberOfDetailRecords
     */
    public function setNumberOfDetailRecords($numberOfDetailRecords)
    {
        $this->numberOfDetailRecords = $numberOfDetailRecords;
    }

    /**
     * @return array|PaymentDetailRecord
     */
    public function getPaymentDetailRecords()
    {
        return $this->paymentDetailRecords;
    }

    /**
     * @param array|PaymentDetailRecord $paymentDetailRecords
     */
    public function setPaymentDetailRecords($paymentDetailRecords)
    {
        if (!is_array($paymentDetailRecords)) {
            $paymentDetailRecords = array($paymentDetailRecords);
        }
        $this->paymentDetailRecords = $paymentDetailRecords;
    }
}
