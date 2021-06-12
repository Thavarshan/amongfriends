# Guide

Once you are at the welcome screen you should be able to see a text box with the label **Billing records in JSON format** and a button that says **Upload billing records**. You can either copy and paste the appropriate format of billing data on the text-box or upload a `.txt` or `.json` file.

> Please use valid `JSON` data format otherwise the application will reject your request.

A sample data format is provided:

```json
[
    {
        "day": 1,
        "amount": 50,
        "paid_by": "Tanu",
        "friends": ["Kasun", "Tanu"]
    },
    {
        "day": 2,
        "amount": 100,
        "paid_by": "Kasun",
        "friends": ["Kasun", "Tanu", "Liam"]
    },
    {
        "day": 3,
        "amount": 100,
        "paid_by": "Liam",
        "friends": ["Liam", "Tanu", "Liam"]
    }
]
```

A variation of the billing data that you may use is of **friends-of-friend** concept. This is where one of your friends brings along their friends and the bill is split according to the number of people using it but the person who brings along his/her friends will have to pay for their friends.

Sample data for such a scenario is provided:

```JSON
[
    {
        "day": 1,
        "amount": 50,
        "paid_by": "Tanu",
        "friends": ["Kasun", "Tanu"]
    },
    {
        "day": 2,
        "amount": 100,
        "paid_by": "Kasun",
        "friends": ["Kasun", ["Tanu", "Ken"], "Liam"]
    },
    {
        "day": 3,
        "amount": 100,
        "paid_by": "Liam",
        "friends": ["Liam", "Tanu", "Liam"]
    }
]
```

**The application will only let you use it 3 times before locking up for 10 minutes. This is to prevent spamming.**
