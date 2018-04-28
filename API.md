##1. All kinds of read (select)

**POST find_product.php**
**POST find_user.php**
**POST find_order.php**
**POST find_order-detail.php**
**POST find_rating.php**
**POST find_cart.php**

Params(form data)(product example):

`PID`
`model`
`brand`
`color`
`price`
`use_time`
`state`
`sellerID`
`image`
`sell_time`

Return:

```
[
    {
        "PID":"00001",
        "brand": "Apple",
        "model": "iPhone X",
        "year": "2017-10-01",
        "color": "grey",
        "use_time": "0.2",
        "price": "892.08",
        "state": "0",
        "image": "2",
        "sell_time": "2015-08-31 13 : 05 : 28",
        "sellerID": "00002"
    },
    {
       ......//same
    }
]
```

##2. All kinds of delete

**POST delete_product.php**
**POST delete_user.php**
**POST delete_order.php**
**POST delete_order-detail.php**
**POST delete_rating.php**
**POST delete_cart.php**

Params(form data)(product example):

`PID`
`model`
`brand`
`color`
`price`
`use_time`
`state`
`sellerID`
`image`
`sell_time`

Return:

```

```

##2. All kinds of delete

**POST update_product.php**
**POST update_user.php**
**POST update_order.php**
**POST update_order-detail.php**
**POST update_rating.php**
**POST update_cart.php**

Params(form data)(product example):

`PID`
`model`
`brand`
`color`
`price`
`use_time`
`state`
`sellerID`
`image`
`sell_time`

Return:

```

```
