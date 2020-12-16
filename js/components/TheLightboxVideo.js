export default {
    name: 'TheLightboxVideo',
    props: ['piece'],


    data: function() {
        return {
            projectName: this.piece.Title,
            projectDate: this.piece.Date,
            projectDesc: this.piece.Description,
            projectVideo: this.piece.Video,
        }
    },

    template: `
        <div class="lbVideo">
            
        </div>
    `,
}