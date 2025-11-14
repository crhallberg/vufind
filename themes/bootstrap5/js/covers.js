/*global VuFind */
VuFind.register('covers', function covers() {
  /**
   * Load a cover image for a single element by making an AJAX call.
   * @param {HTMLElement} ajaxCoverEl The element to update with the cover image.
   */
  function loadCoverByElement(ajaxCoverEl) {
    const img = ajaxCoverEl.querySelector("img");
    const spinner = ajaxCoverEl.querySelector(".spinner");
    const container = ajaxCoverEl.querySelector(".cover-container");

    const queryParams = new URLSearchParams({
      method: "getRecordCover",
      source: img.dataset.recordsource,
      recordId: img.dataset.recordid,
      size: img.dataset.coversize,
      context: img.dataset.context,
    });

    fetch(VuFind.path + '/AJAX/JSON?' + queryParams.toString())
      .then(response => response.json())
      .then(function coverCallback(response) {
        const coverData = response.data;

        // no cover
        if (!coverData || coverData.url === undefined || coverData.url === false) {
          if (coverData && coverData.html !== undefined) {
            VuFind.setInnerHtml(container, VuFind.updateCspNonce(coverData.html));
          } else {
            container.textContent = "";
          }

          img.remove();
          spinner.remove();
          container.style.display = "block";
          return;
        }

        // load image
        img.src = coverData.url;

        if (
          coverData.backlink_url &&
          coverData.backlink_locations &&
          coverData.backlink_locations.includes(img.dataset.context)
        ) {
          const containingLink = img.closest("a");
          // if our image is already inside of a link
          if (containingLink) {
            // append new link after link
            const link = document.createElement('a');
            link.setAttribute("href", coverData.backlink_url);
            link.classList.add('cover-backlink');
            link.textContent = coverData.backlink_text;
            containingLink.after(link);
          } else {
            // change URL
            containingLink.setAttribute("href", coverData.backlink_url);
            // append text after image
            const backlink = document.createElement("span");
            backlink.classList.add('cover-source-text');
            backlink.textContent = coverData.backlink_text;
            img.after(backlink);
          }
        }

        spinner.remove();
        container.style.display = "block";
      });
  }
  /**
   * Find and load cover images for all `.ajaxcover` elements within a container.
   * @param {HTMLElement} container The container to search for `.ajaxcover` elements.
   */
  function loadCovers(container) {
    container.querySelectorAll('.ajaxcover').forEach(
      (cover) => {
        if (cover.dataset.loaded) {
          return;
        }
        cover.dataset.loaded = true;
        loadCoverByElement(cover);
      }
    );
  }

  /**
   * Update a container by loading covers and checking the loaded state.
   * @param {object} params An object containing the container element.
   */
  function updateContainer(params) {
    loadCovers(params.container);
  }

  /**
   * Initialize the covers module by loading covers on page load
   */
  function init() {
    updateContainer({ container: document });
    VuFind.listen('results-init', updateContainer);
  }

  return { init };
});
