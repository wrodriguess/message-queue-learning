<?php

namespace App\Enum;

enum PaymentMethod: string
{
    case CARTAO_CREDITO = 'cartao_credito';
    case PIX = 'pix';
    case BOLETO = 'boleto';
}