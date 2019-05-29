<?php

namespace App\Utils;

class Error
{
    const NOT_ADMIN = 'Only Admins can access this';
    const AUTH = 'Invalid Credentials';

    const PRODUCT_CREATE_ERROR = 'Unable to create product';
    const BUNDLE_CREATE_ERROR = 'Unable to create bundle';

    const ORDER_CREATE = 'Unable to create order';

    const FATAL = 'Something went wrong';
}