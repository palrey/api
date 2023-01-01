import { useDispatch as uDispatch, useSelector as uSelector, TypedUseSelectorHook } from 'react-redux'
import { AuthActions } from './slices/auth';
import type { AppDispatch, RootState } from './store';

export const useDispatch: () => AppDispatch = uDispatch;
export const useSelector: TypedUseSelectorHook<RootState> = uSelector;
/**
 * -----------------------------------------
 *	Slices
 * -----------------------------------------
 */

export { AuthActions }

