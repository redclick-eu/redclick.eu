export const maybe_var = (variable, dflt) => {
    if (variable) {
        return variable
    } else {
        return dflt;
    }
}

export const parse_json_vars = (json_str, defaults = {}, default_json_str = '[]') => {
    return {
        ...defaults, ...JSON.parse(json_str || default_json_str),
    };
}

export const match_some = (element, selectors) => {
    return selectors.some((selector) => element.matches(selector))
}
