export default {
    name: 'TheLightboxImages',
    props: ['piece'],

    data: function() {
        return {
            projectName: this.piece.Title,
            projectDate: this.piece.Date,
            projectDesc: this.piece.Description,
            projectImage1: this.piece.Image1,
            projectImage1: this.piece.Image2,
            projectImage1: this.piece.Image3,
        }
    },

    template: `
        <div class="lbImages">
        
        </div>
    `,
}