export default class Points {
    constructor(value = 0) {
        this.pointsEl = '#points';
        
        this.value = value;
    }

    set(value) {
        this.value = value;
    }

    show() {
        $(this.pointsEl).text(this.value);
    }

    animation(value, type = 'increase') {
        let point = this.buildPoint(value, type);

        $('.mid').append(point);

        setTimeout(() => {
            point.remove();
        }, 1000)
    }

    buildPoint(value, type) {
        let point = $('<div class="point"></div>');
        point.addClass(type);

        let top = Math.floor((Math.random() * 50) - 50);
        let left = Math.floor((Math.random() * 14) + 44);
        let sign = '+';

        if (type === 'decrease') {
            sign = '-';
        }

        left += '%';
        top += 'px';

        point.text(sign + value);
        point.css({
            left: left,
            top: top
        });

        return point;
    }
}