import STATE from "./loadingState";

export const ProjectMixins = {
    computed: {
        filtredProjects() {
            return this.$store.getters.getProjects.data;
        },
    },

    methods: {
        thumbnailPath(project, size) {
            if (!project || this.$store.getters.getProjectsLoadStatus !== STATE.SUCCESS) {
                return null;
            }
            let degree = this.$route.params.degree ? this.$route.params.degree : 'bachelor', year = this.$store.getters.getYear, uuid = project.student.uuid;

            uuid = 'dossantos-diogo'; // for now
            let path = ['/storage', 'projects', year, degree, uuid, 'thumbnail', 'x' + size, uuid + '_thumbnail' + 'x' + size + '.jpg'];
            return path.join('/');
        }
    }
}
