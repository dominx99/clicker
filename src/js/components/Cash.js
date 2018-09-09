export default class Cash {
    constructor(value = 0) {
        this.cashEl = '#cash';
        
        this.value = value;
    }

    set(value) {
        this.value = value;
    }

    show() {
        $(this.cashEl).text(this.value);
    }
}