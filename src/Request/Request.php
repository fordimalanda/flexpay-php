<?php

declare(strict_types=1);

namespace Devscast\Flexpay\Request;

use Devscast\Flexpay\Data\Currency;

/**
 * Class CardRequest.
 * * Cette classe gère les requêtes de paiement par carte (Visa/Mastercard).
 * Elle étend la classe Request en rendant les URLs et la description optionnelles.
 * * @author bernard-ng <bernard@devscast.tech>
 */
class CardRequest extends Request
{
    /**
     * CardRequest constructor.
     * * @param float $amount Le montant de la transaction
     * @param string $reference La référence unique de la transaction
     * @param Currency $currency La devise (CDF ou USD)
     * @param string $callbackUrl L'URL de notification (Webhook)
     * @param string $description Une description optionnelle
     * @param string $approveUrl URL de redirection après succès
     * @param string $cancelUrl URL de redirection après annulation
     * @param string $declineUrl URL de redirection après échec
     * @param string $homeUrl URL de retour à l'accueil du site marchand
     */
    public function __construct(
        float $amount,
        string $reference,
        Currency $currency,
        string $callbackUrl,
        string $description = '',
        string $approveUrl = '',
        string $cancelUrl = '',
        string $declineUrl = '',
        public string $homeUrl = ''
    ) {
        parent::__construct(
            amount: $amount,
            reference: $reference,
            currency: $currency,
            callbackUrl: $callbackUrl,
            approveUrl: $approveUrl,
            description: $description,
            cancelUrl: $cancelUrl,
            declineUrl: $declineUrl
        );
    }

    /**
     * Génère le corps de la requête pour l'API Flexpay.
     * Les clés correspondent aux attentes de la passerelle de carte.
     * * @return array
     */
    public function getPayload(): array
    {
        return [
            'merchant' => $this->merchant,
            'reference' => $this->reference,
            'amount' => $this->amount,
            'currency' => $this->currency->value,
            'description' => $this->description,
            'callback_url' => $this->callbackUrl,
            'approve_url' => $this->approveUrl,
            'cancel_url' => $this->cancelUrl,
            'decline_url' => $this->declineUrl,
            'home_url' => $this->homeUrl,
        ];
    }
}