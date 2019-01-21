<?php

namespace Kazin8\Elopage\Dto;

use Kazin8\Elopage\Dto\Webhook\AuthorCommissionDto;
use Kazin8\Elopage\Dto\Webhook\AuthorDto;
use Kazin8\Elopage\Dto\Webhook\EventDto;
use Kazin8\Elopage\Dto\Webhook\GiftReceiverDto;
use Kazin8\Elopage\Dto\Webhook\OptInsDto;
use Kazin8\Elopage\Dto\Webhook\PayerDto;
use Kazin8\Elopage\Dto\Webhook\PricingPlanDto;
use Kazin8\Elopage\Dto\Webhook\ProductDto;
use Kazin8\Elopage\Dto\Webhook\PublisherDto;
use Kazin8\Elopage\Dto\Webhook\TicketDto;
use Kazin8\Elopage\Dto\Webhook\UpsellDto;

class WebhookDto extends AbstractDto
{
    protected $id;
    protected $action;
    protected $voucherCodes;
    protected $addId1;
    protected $addId2;
    protected $billNumber;
    protected $revenue;
    protected $amount;
    protected $fee;
    protected $vatRate;
    protected $vatAmount;
    protected $campaignId;
    protected $couponCode;
    protected $recurring;
    protected $recurringForm;
    protected $paymentMethod;
    protected $paymentSessionId;
    protected $paymentSessionToken;
    protected $salesPageId;
    protected $state;
    protected $createdDate;
    protected $successDate;
    protected $successDateShort;
    protected $invoiceLink;
    protected $successLink;
    protected $creditMemoLink;
    protected $refundedTransferId;
    protected $errorMsg;

    /** @var PayerDto $payer */
    protected $payer;

    /** @var PublisherDto $publisher */
    protected $publisher;

    protected $authors = [];

    /** @var ProductDto $product */
    protected $product;

    /** @var PricingPlanDto $pricingPlan */
    protected $pricingPlan;

    /** @var UpsellDto $upsell */
    protected $upsell;

    protected $events = [];

    protected $tickets = [];

    /** @var GiftReceiverDto $giftReceiver */
    protected $giftReceiver;

    protected $optIns = [];

    protected $authorCommissions = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if ($data) {
            $this
                ->setPayer(new PayerDto($data['payer'] ?? []))
                ->setPublisher(new PublisherDto($data['publisher'] ?? []))
                ->setProduct(new ProductDto($data['product'] ?? []))
                ->setPricingPlan(new PricingPlanDto($data['pricing_plan'] ?? []))
                ->setUpsell(new UpsellDto($data['upsell'] ?? []));

            if (isset($data['authors'])) {
                foreach ($data['authors'] as $author) {
                    $this->addAuthor(new AuthorDto($author));
                }
            }

            if (isset($data['events'])) {
                foreach ($data['events'] as $event) {
                    $this->addEvent(new EventDto($event));
                }
            }

            if (isset($data['tickets'])) {
                foreach ($data['tickets'] as $ticket) {
                    $this->addTicket(new TicketDto($ticket));
                }
            }

            if (isset($data['opt_ins'])) {
                foreach ($data['opt_ins'] as $optIn) {
                    $this->addOptIns(new OptInsDto($optIn));
                }
            }

            if (isset($data['author_commissions'])) {
                foreach ($data['author_commissions'] as $authorCommission) {
                    $this->addAuthorCommissions(new AuthorCommissionDto($authorCommission));
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     *
     * @return self
     */
    public function setAction($action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoucherCodes()
    {
        return $this->voucherCodes;
    }

    /**
     * @param mixed $voucherCodes
     *
     * @return self
     */
    public function setVoucherCodes($voucherCodes): self
    {
        $this->voucherCodes = $voucherCodes;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddId1()
    {
        return $this->addId1;
    }

    /**
     * @param mixed $addId1
     *
     * @return self
     */
    public function setAddId1($addId1): self
    {
        $this->addId1 = $addId1;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddId2()
    {
        return $this->addId2;
    }

    /**
     * @param mixed $addId2
     *
     * @return self
     */
    public function setAddId2($addId2): self
    {
        $this->addId2 = $addId2;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillNumber()
    {
        return $this->billNumber;
    }

    /**
     * @param mixed $billNumber
     *
     * @return self
     */
    public function setBillNumber($billNumber): self
    {
        $this->billNumber = $billNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * @param mixed $revenue
     *
     * @return self
     */
    public function setRevenue($revenue): self
    {
        $this->revenue = $revenue;

        return $this;
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
     *
     * @return self
     */
    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param mixed $fee
     *
     * @return self
     */
    public function setFee($fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVatRate()
    {
        return $this->vatRate;
    }

    /**
     * @param mixed $vatRate
     *
     * @return self
     */
    public function setVatRate($vatRate): self
    {
        $this->vatRate = $vatRate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVatAmount()
    {
        return $this->vatAmount;
    }

    /**
     * @param mixed $vatAmount
     *
     * @return self
     */
    public function setVatAmount($vatAmount): self
    {
        $this->vatAmount = $vatAmount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }

    /**
     * @param mixed $campaignId
     *
     * @return self
     */
    public function setCampaignId($campaignId): self
    {
        $this->campaignId = $campaignId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCouponCode()
    {
        return $this->couponCode;
    }

    /**
     * @param mixed $couponCode
     *
     * @return self
     */
    public function setCouponCode($couponCode): self
    {
        $this->couponCode = $couponCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * @param mixed $recurring
     *
     * @return self
     */
    public function setRecurring($recurring): self
    {
        $this->recurring = $recurring;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecurringForm()
    {
        return $this->recurringForm;
    }

    /**
     * @param mixed $recurringForm
     *
     * @return self
     */
    public function setRecurringForm($recurringForm): self
    {
        $this->recurringForm = $recurringForm;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param mixed $paymentMethod
     *
     * @return self
     */
    public function setPaymentMethod($paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentSessionId()
    {
        return $this->paymentSessionId;
    }

    /**
     * @param mixed $paymentSessionId
     *
     * @return self
     */
    public function setPaymentSessionId($paymentSessionId): self
    {
        $this->paymentSessionId = $paymentSessionId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentSessionToken()
    {
        return $this->paymentSessionToken;
    }

    /**
     * @param mixed $paymentSessionToken
     *
     * @return self
     */
    public function setPaymentSessionToken($paymentSessionToken): self
    {
        $this->paymentSessionToken = $paymentSessionToken;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalesPageId()
    {
        return $this->salesPageId;
    }

    /**
     * @param mixed $salesPageId
     *
     * @return self
     */
    public function setSalesPageId($salesPageId): self
    {
        $this->salesPageId = $salesPageId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     *
     * @return self
     */
    public function setState($state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $createdDate
     *
     * @return self
     */
    public function setCreatedDate($createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuccessDate()
    {
        return $this->successDate;
    }

    /**
     * @param mixed $successDate
     *
     * @return self
     */
    public function setSuccessDate($successDate): self
    {
        $this->successDate = $successDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuccessDateShort()
    {
        return $this->successDateShort;
    }

    /**
     * @param mixed $successDateShort
     *
     * @return self
     */
    public function setSuccessDateShort($successDateShort): self
    {
        $this->successDateShort = $successDateShort;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInvoiceLink()
    {
        return $this->invoiceLink;
    }

    /**
     * @param mixed $invoiceLink
     *
     * @return self
     */
    public function setInvoiceLink($invoiceLink): self
    {
        $this->invoiceLink = $invoiceLink;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuccessLink()
    {
        return $this->successLink;
    }

    /**
     * @param mixed $successLink
     *
     * @return self
     */
    public function setSuccessLink($successLink): self
    {
        $this->successLink = $successLink;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreditMemoLink()
    {
        return $this->creditMemoLink;
    }

    /**
     * @param mixed $creditMemoLink
     *
     * @return self
     */
    public function setCreditMemoLink($creditMemoLink): self
    {
        $this->creditMemoLink = $creditMemoLink;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRefundedTransferId()
    {
        return $this->refundedTransferId;
    }

    /**
     * @param mixed $refundedTransferId
     *
     * @return self
     */
    public function setRefundedTransferId($refundedTransferId): self
    {
        $this->refundedTransferId = $refundedTransferId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorMsg()
    {
        return $this->errorMsg;
    }

    /**
     * @param mixed $errorMsg
     *
     * @return self
     */
    public function setErrorMsg($errorMsg): self
    {
        $this->errorMsg = $errorMsg;

        return $this;
    }

    /**
     * @return PayerDto
     */
    public function getPayer(): PayerDto
    {
        return $this->payer;
    }

    /**
     * @param PayerDto $payer
     *
     * @return self
     */
    public function setPayer(PayerDto $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * @return PublisherDto
     */
    public function getPublisher(): PublisherDto
    {
        return $this->publisher;
    }

    /**
     * @param PublisherDto $publisher
     *
     * @return self
     */
    public function setPublisher(PublisherDto $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @param array $authors
     *
     * @return self
     */
    public function setAuthors(array $authors): self
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * @param AuthorDto $author
     *
     * @return self
     */
    public function addAuthor(AuthorDto $author): self
    {
        $this->authors[] = $author;

        return $this;
    }

    /**
     * @return ProductDto
     */
    public function getProduct(): ProductDto
    {
        return $this->product;
    }

    /**
     * @param ProductDto $product
     *
     * @return self
     */
    public function setProduct(ProductDto $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return PricingPlanDto
     */
    public function getPricingPlan(): PricingPlanDto
    {
        return $this->pricingPlan;
    }

    /**
     * @param PricingPlanDto $pricingPlan
     *
     * @return self
     */
    public function setPricingPlan(PricingPlanDto $pricingPlan): self
    {
        $this->pricingPlan = $pricingPlan;

        return $this;
    }

    /**
     * @return UpsellDto
     */
    public function getUpsell(): UpsellDto
    {
        return $this->upsell;
    }

    /**
     * @param UpsellDto $upsell
     *
     * @return self
     */
    public function setUpsell(UpsellDto $upsell): self
    {
        $this->upsell = $upsell;

        return $this;
    }

    /**
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * @param array $events
     *
     * @return self
     */
    public function setEvents(array $events): self
    {
        $this->events = $events;

        return $this;
    }

    /**
     * @param EventDto $event
     *
     * @return self
     */
    public function addEvent(EventDto $event): self
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * @return array
     */
    public function getTickets(): array
    {
        return $this->tickets;
    }

    /**
     * @param array $tickets
     *
     * @return self
     */
    public function setTickets(array $tickets): self
    {
        $this->tickets = $tickets;

        return $this;
    }

    /**
     * @param TicketDto $ticket
     *
     * @return self
     */
    public function addTicket(TicketDto $ticket): self
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * @return GiftReceiverDto
     */
    public function getGiftReceiver(): GiftReceiverDto
    {
        return $this->giftReceiver;
    }

    /**
     * @param GiftReceiverDto $giftReceiver
     *
     * @return self
     */
    public function setGiftReceiver(GiftReceiverDto $giftReceiver): self
    {
        $this->giftReceiver = $giftReceiver;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptIns(): array
    {
        return $this->optIns;
    }

    /**
     * @param array $optIns
     *
     * @return self
     */
    public function setOptIns(array $optIns): self
    {
        $this->optIns = $optIns;

        return $this;
    }

    /**
     * @param OptInsDto $optIns
     *
     * @return self
     */
    public function addOptIns(OptInsDto $optIns): self
    {
        $this->tickets[] = $optIns;

        return $this;
    }

    /**
     * @return array
     */
    public function getAuthorCommissions(): array
    {
        return $this->authorCommissions;
    }

    /**
     * @param array $authorCommissions
     *
     * @return self
     */
    public function setAuthorCommissions(array $authorCommissions): self
    {
        $this->authorCommissions = $authorCommissions;

        return $this;
    }

    /**
     * @param AuthorCommissionDto $authorCommissions
     *
     * @return self
     */
    public function addAuthorCommissions(AuthorCommissionDto $authorCommissions): self
    {
        $this->authorCommissions[] = $authorCommissions;

        return $this;
    }

}