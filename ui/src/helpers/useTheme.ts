type ITheme = "light" | "dark" | null;
/**
 * useTheme
 * @returns
 */
export const useTheme = () => {

	const element = document.getElementsByTagName('html')[0];

	return {
		/**
		 * current
		 * @returns
		 */
		current: (): ITheme => element.getAttribute('data-theme') as ITheme,
		/**
		 * set
		 * @param t
		 */
		set: (t: ITheme) => {
			if (element)
				element.setAttribute('data-theme', String(t))
		}
	}
}
