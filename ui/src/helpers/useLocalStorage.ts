export function useLocalStorage() {
    return {
        /**
         * get
         * @param key
         * @returns
         */
        get<T>(key: string) {
            const item = localStorage.getItem(`useStorage/${key}`);
            if (item) return JSON.parse(item) as T;
        },
        /**
         * set
         * @param key
         * @param value
         * @returns
         */
        set<T>(key: string, value: T) {
            return localStorage.setItem(`useStorage/${key}`, JSON.stringify(value));
        }
    }
}
