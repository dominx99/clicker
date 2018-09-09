import Points from "./Points";
import Cash from './Cash';
import Statistics from './Statistics';

export default class User {
    constructor() {
        this.cash = new Cash(0);
        this.points = new Points(0);
        this.statistics = new Statistics();

        this.getData();
    }

    getData() {
        $.ajax({
            url: 'user/fetch',
            type: 'get',
        })
        .done(data => this.assignValues(data))
        .fail(xhr => this.gotError(xhr));
    }

    assignValues(data) {
        this.cash.set(data.cash);
        this.points.set(data.points);
        this.statistics.set(data);

        // console.log(data);

        this.showValues();
    }

    showValues() {
        this.cash.show();
        this.points.show();
        this.statistics.show();
    }

    gotError() {
        console.log('error');
    }
}