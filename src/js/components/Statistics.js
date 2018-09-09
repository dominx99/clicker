export default class Points {
    constructor() {
        this.perClickEl = '#perClick';
        this.perSecEl = '#perSec';
        
        this.values = {
            per_click: {},
            per_sec: {},
        };
    }

    set(data) {
        this.values.per_click = data.per_click;
        this.values.per_sec = data.per_sec;
    }

    show() {
        $(this.perClickEl).text(this.values.per_click.value);
        $(this.perSecEl).text(this.values.per_sec.value);
        
        $(this.perClickEl + "Level").text(this.values.per_click.level);
        $(this.perClickEl + "NextLevel").text(this.values.per_click.next_level);
        $(this.perClickEl + "Cost").text(this.values.per_click.next_cost);

        $(this.perSecEl + "Level").text(this.values.per_sec.level);
        $(this.perSecEl + "NextLevel").text(this.values.per_sec.next_level);
        $(this.perSecEl + "Cost").text(this.values.per_sec.next_cost);
    }
}