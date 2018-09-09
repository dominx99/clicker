export default class Ranking {
    constructor() {
        this.getData();

        this.bind();
    }

    bind() {
        setInterval(() => this.getData(), 1500);
    }

    getData() {
        $.ajax({
            url: 'ranking',
            type: 'get',
            success: users => this.update(users),
            error: xhr => this.gotError(xhr),
        });
    }

    update(users) {
        let ranking = this.buildRanking(users);

        $('.ranking ul').remove();
        $('.ranking').append(ranking);
    }

    gotError(xhr) {
        console.log('error');
    }

    buildRanking(users) {
        let ul = $('<ul></ul>');
        let liPattern = $('<li></li>');
        let nickPattern = $('<div class="name"></div>')
        let pointsPattern = $('<div class="points"></div>')

        users.forEach((user, index) => {
            let li = liPattern.clone();
            let nick = nickPattern.clone();
            let points = pointsPattern.clone();
            let fullNick = (index + 1) + '. ' + user.nick;

            nick.text(fullNick);
            points.text(user.points);

            li.append(nick);
            li.append(points);

            ul.append(li);
        });

        return ul;
    }
}