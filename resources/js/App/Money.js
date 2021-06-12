import config from '../Config';

class Money {
    /**
     * Create new money untilities helper instance.
     *
     * @return  {void}
     */
    constructor(currency = null, locale = null) {
        this.formatter = new Intl.NumberFormat(
            locale || config('billing.currency_locale'),
            {
                style: 'currency',
                currency: currency || config('billing.currency'),
            }
        );
    }

    /**
     * Format the given integer amount to a presentable currency format.
     *
     * @param   {Integer}  amount
     *
     * @return  {String}
     */
    format(amount) {
        return this.formatter.format(amount);
    }
}

export default Money;
