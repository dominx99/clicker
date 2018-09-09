export default class Shop {
    constructor() {
        this.buyClickEl = '#buyClick';
        this.buySecEl = '#buySec';

        this.bind();
    }

    bind() {
        $('body').on('click', this.buyClickEl, () => this.buy('click'));
        $('body').on('click', this.buySecEl, () => this.buy('sec'));
    }

    buy(type) {
        this.disableButtons();
        this.type = type;

        $.ajax({
           url: 'buy/' + type,
           type: 'post',
           success: data => this.successBuy(data),
           error: xhr => this.gotError(xhr),
           complete: this.enableButtons(),
        });
    }

    successBuy(data, type) {
        if (data.error) {
            alert(data.error);
            return;
        }

        type = 'per_' + this.type;
        let value = data[type].cost;

        user.points.animation(value, 'decrease');
        user.assignValues(data);
    }

    enableButtons() {
        $(this.buyClickEl).prop('disabled', false);
        $(this.buySecEl).prop('disabled', false);

        $(this.buyClickEl).removeClass('disabled');
        $(this.buySecEl).removeClass('disabled');
    }

    disableButtons() {
        $(this.buyClickEl).prop('disabled', true);
        $(this.buySecEl).prop('disabled', true);

        $(this.buyClickEl).addClass('disabled');
        $(this.buySecEl).addClass('disabled');
    }

    gotError(xhr) {
        console.log('error');
    }
}