import { objectEach } from './object';

const tester = (testerFunc) => {
  const result = {
    value: false,
  };
  result.test = (ua, vendor) => {
    result.value = testerFunc(ua, vendor);
  };

  return result;
};

const browsers = {
  chrome: tester((ua, vendor) => /Chrome/.test(ua) && /Google/.test(vendor)),
  edge: tester(ua => /Edge/.test(ua)),
  firefox: tester(ua => /Firefox/.test(ua)),
  ie: tester(ua => /Trident/.test(ua)),
  // eslint-disable-next-line no-restricted-globals
  ie9: tester(() => !!(document.documentMode)),
  mobile: tester(ua => /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(ua)),
  safari: tester((ua, vendor) => /Safari/.test(ua) && /Apple Computer/.test(vendor)),
};

const platforms = {
  mac: tester(platform => /^Mac/.test(platform)),
  win: tester(platform => /^Win/.test(platform)),
  linux: tester(platform => /^Linux/.test(platform)),
};

/**
 * @param {object} [metaObject] The browser identity collection.
 * @param {object} [metaObject.userAgent] The user agent reported by browser.
 * @param {object} [metaObject.vendor] The vendor name reported by browser.
 */
export function setBrowserMeta({ userAgent = navigator.userAgent, vendor = navigator.vendor } = {}) {
  objectEach(browsers, ({ test }) => void test(userAgent, vendor));
}

/**
 * @param {object} [metaObject] The platform identity collection.
 * @param {object} [metaObject.platform] The platform ID.
 */
export function setPlatformMeta({ platform = navigator.platform } = {}) {
  objectEach(platforms, ({ test }) => void test(platform));
}

setBrowserMeta();
setPlatformMeta();

/**
 * @returns {boolean}
 */
export function isChrome() {
  return browsers.chrome.value;
}

/**
 * @returns {boolean}
 */
export function isEdge() {
  return browsers.edge.value;
}

/**
 * @returns {boolean}
 */
export function isIE() {
  return browsers.ie.value;
}

/**
 * @returns {boolean}
 */
export function isIE9() {
  return browsers.ie9.value;
}

/**
 * @returns {boolean}
 */
export function isMSBrowser() {
  return browsers.ie.value || browsers.edge.value;
}

/**
 * @returns {boolean}
 */
export function isMobileBrowser() {
  return browsers.mobile.value;
}

/**
 * @returns {boolean}
 */
export function isSafari() {
  return browsers.safari.value;
}

/**
 * @returns {boolean}
 */
export function isFirefox() {
  return browsers.firefox.value;
}

/**
 * @returns {boolean}
 */
export function isWindowsOS() {
  return platforms.win.value;
}

/**
 * @returns {boolean}
 */
export function isMacOS() {
  return platforms.mac.value;
}

/**
 * @returns {boolean}
 */
export function isLinuxOS() {
  return platforms.linux.value;
}