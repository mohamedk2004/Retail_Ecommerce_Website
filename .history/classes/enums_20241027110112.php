<?php
    // Roles
    enum Role: string {
        case Customer = 'customer';
        case Admin = 'admin';
    }

    enum PaymentMethod: string {
        case Cash = 'cash on delivery';
        case Fawry = 'fawry';
        case CreditCard = 'credit card';
    }

    enum OrderStatus : string {
    case Pending = 'pending';
    case S
    }