import STATE from "./loadingState";

export const ProjectMixins = {
    computed: {
        bachelorProjects() {
            if (this.$store.getters.getProjectsLoadStatus != 2) return null;
            return this.$store.getters.getProjects.data.filter(p => {
                return p.degree == "bachelor";
            });
        },

        masterProjects() {
            if (this.$store.getters.getProjectsLoadStatus != 2) return null;
            return this.$store.getters.getProjects.data.filter(p => {
                return p.degree == "master";
            });
        },
    },
}
