export default class Clicker {
    constructor() {
        this.el = "#clicker";

        this.bind();
    }

    bind() {
        $('body').on('click', this.el, () => this.click());

        setInterval(() => this.sec(), 1000);
    }

    click() {
        $.ajax({
            url: 'click',
            type: 'post',
            success: data => this.successClick(data),
            error: xhr => this.gotError(xhr),
        });
    }

    successClick(data) {
        user.points.animation(data.per_click.value);

        user.assignValues(data);
    }

    successSec(data) {
        user.points.animation(data.per_sec.value);

        user.assignValues(data);
    }

    sec() {
        if (document.hasFocus()) {
            $.ajax({
                url: 'sec',
                type: 'post',
                success: data => this.successSec(data),
                error: xhr => this.gotError(xhr),
            });
        }
    }

    gotError() {
        console.log('error');
    }
}
