export const maybeVar = (variable, dflt) => {
    if (variable) {
        return variable;
    }
    return dflt;
};

export const parseJsonVars = (jsonStr, defaults = {}, defaultJsonStr = '[]') => ({
    ...defaults, ...JSON.parse(jsonStr || defaultJsonStr),
});

export const matchSome = (el, selectors) => selectors.some((selector) => el.matches(selector));
