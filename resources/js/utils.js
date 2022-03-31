import ReactDOM from 'react-dom';

export function registerComponentToDom (elementId, Component) {
  if (document.getElementById(elementId)) {
    const el = document.getElementById(elementId);
    const props = convertDatasetToProps(el.dataset);

    ReactDOM.render(<Component {...props} />, el);
  }
}
export function convertDatasetToProps (dataset) {
  const props = {};
  Object.keys(dataset).map(key => {
    props[key] = JSON.parse(dataset[key]);
  });

  return props;
}
