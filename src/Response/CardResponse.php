<?php

declare(strict_types=1);

namespace Devscast\Flexpay\Response;

use Devscast\Flexpay\Data\Status;
use Symfony\Component\Serializer\Attribute\SerializedName;

/**
 * Class CardResponse.
 * * Représente la réponse suite à une demande de paiement par carte.
 * Elle inclut l'URL de redirection vers la passerelle de paiement.
 *
 * @author bernard-ng <bernard@devscast.tech>
 */
final class CardResponse extends FlexpayResponse
{
    public function __construct(
        public Status $code,
        public string $message = '',
        
        #[SerializedName('orderNumber')]
        public ?string $orderNumber = null,
        
        public ?string $url = null
    ) {
    }
}