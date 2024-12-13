<?php
    enum Role: string {
        case Customer = 'user';
        case Admin = 'admin';
    }

    enum PaymentMethod: string {
        case Cash = 'cash on delivery';
        case Fawry = 'fawry';
        case CreditCard = 'credit card';
    }

    enum OrderStatus : string {
        case Pending = 'pending';
        case Shipped = 'shipped';
        case Delivered = 'delivered';
    }