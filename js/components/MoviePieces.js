export default {
    name: "pieceThumb",
    props: ['piece'],

    data: function() {
        return {
            projectName: this.piece.Title,
            projectDate: this.piece.Date
        }
    },

    template:
    `<div class="work" data-aos="fade-up">
 
    </div>`,
}